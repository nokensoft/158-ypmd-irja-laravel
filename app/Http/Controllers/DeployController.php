<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeployController extends Controller
{
    /**
     * Handle GitHub webhook for auto-deployment.
     *
     * Validates the webhook signature, checks if the push is to the main branch,
     * and executes the deploy script in the background.
     */
    public function webhook(Request $request)
    {
        // 1. Validate webhook secret signature
        $secret = config('app.deploy_secret');

        if (empty($secret)) {
            Log::error('Deploy: DEPLOY_SECRET is not configured.');
            return response()->json(['message' => 'Server misconfigured.'], 500);
        }

        $signature = $request->header('X-Hub-Signature-256');

        if (empty($signature)) {
            Log::warning('Deploy: Request missing X-Hub-Signature-256 header.');
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $payload = $request->getContent();
        $expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

        if (! hash_equals($expectedSignature, $signature)) {
            Log::warning('Deploy: Invalid webhook signature.');
            return response()->json(['message' => 'Invalid signature.'], 403);
        }

        // 2. Check if the event is a push to the main branch
        $event = $request->header('X-GitHub-Event');

        if ($event !== 'push') {
            return response()->json(['message' => "Ignored event: {$event}."]);
        }

        $branch = $request->input('ref');

        if ($branch !== 'refs/heads/main') {
            return response()->json(['message' => "Ignored branch: {$branch}."]);
        }

        // 3. Execute deploy script in background
        $deployScript = base_path('deploy.sh');

        if (! file_exists($deployScript)) {
            Log::error('Deploy: deploy.sh not found.');
            return response()->json(['message' => 'Deploy script not found.'], 500);
        }

        // Run in background so GitHub doesn't timeout waiting for response
        $command = "bash {$deployScript} > /dev/null 2>&1 &";
        exec($command);

        Log::info('Deploy: Deployment triggered by push to main.', [
            'commit' => $request->input('after'),
            'pusher' => $request->input('pusher.name'),
        ]);

        return response()->json(['message' => 'Deployment started.']);
    }
}
