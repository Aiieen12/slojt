<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\OjtProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DailyLogController extends Controller
{
    protected function ensureStudentAccess(): void
    {
        abort_if(Auth::user()?->isAdmin(), 403);
    }

    protected function isDraftRequest(Request $request): bool
    {
        return $request->input('save_action') === 'draft';
    }

    protected function validateDailyLog(Request $request, bool $isDraft): array
    {
        $rules = [
            'save_action' => 'nullable|in:draft,completed',
            'day_no' => 'required|integer|min:1',
            'log_date' => 'required|date',
            'location' => 'nullable|string',
            'department_unit' => 'nullable|string',
            'daily_activity' => [$isDraft ? 'nullable' : 'required', 'string'],
            'knowledge_skill' => 'nullable|string',
            'tools_technology' => 'nullable|string',
            'issue_challenge_type' => [$isDraft ? 'nullable' : 'required', 'in:issue,image,flowchart'],
            'issue_challenge' => 'nullable|string',
            'issue_challenge_image' => 'nullable|image|max:5120',
            'flowchart_steps' => 'nullable|string',
            'reflection_solution' => 'nullable|string',
        ];

        if (! $isDraft) {
            $rules['issue_challenge'] .= '|required_if:issue_challenge_type,issue';
            $rules['issue_challenge_image'] .= '|required_if:issue_challenge_type,image';
            $rules['flowchart_steps'] .= '|required_if:issue_challenge_type,flowchart';
        }

        return $request->validate($rules);
    }

    public function index()
    {
        $this->ensureStudentAccess();

        $logs = DailyLog::where('user_id', Auth::id())
            ->orderBy('log_date', 'desc')
            ->get();

        return view('daily-logs.index', compact('logs'));
    }

    public function create()
    {
        $this->ensureStudentAccess();

        $profile = OjtProfile::where('user_id', Auth::id())->first();

        return view('daily-logs.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $this->ensureStudentAccess();

        $isDraft = $this->isDraftRequest($request);
        $validated = $this->validateDailyLog($request, $isDraft);

        $profile = OjtProfile::where('user_id', Auth::id())->first();
        $issueChallengeType = $validated['issue_challenge_type'] ?? 'issue';

        $issueChallengeImagePath = null;

        if ($issueChallengeType === 'image' && $request->hasFile('issue_challenge_image')) {
            $issueChallengeImagePath = $request->file('issue_challenge_image')->store('daily-log-issues', 'public');
        }

        DailyLog::create([
            'user_id' => Auth::id(),
            'ojt_profile_id' => $profile?->id,
            'day_no' => $validated['day_no'],
            'log_date' => $validated['log_date'],
            'location' => $validated['location'] ?? null,
            'department_unit' => $validated['department_unit'] ?? null,
            'daily_activity' => $validated['daily_activity'] ?? null,
            'knowledge_skill' => $validated['knowledge_skill'] ?? null,
            'tools_technology' => $validated['tools_technology'] ?? null,
            'issue_challenge_type' => $issueChallengeType,
            'issue_challenge' => $issueChallengeType === 'issue' ? ($validated['issue_challenge'] ?? null) : null,
            'issue_challenge_image_path' => $issueChallengeImagePath,
            'flowchart_steps' => $issueChallengeType === 'flowchart' ? ($validated['flowchart_steps'] ?? null) : null,
            'reflection_solution' => $validated['reflection_solution'] ?? null,
            'status' => $isDraft ? 'draft' : 'completed',
        ]);

        return redirect()
            ->route('daily-logs.index')
            ->with('success', $isDraft ? 'Draf laporan berjaya disimpan.' : 'Laporan harian berjaya disimpan.');
    }

    public function show(DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);

        return view('daily-logs.show', compact('daily_log'));
    }

    public function edit(DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);

        return view('daily-logs.edit', compact('daily_log'));
    }

    public function update(Request $request, DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);

        $isDraft = $this->isDraftRequest($request);
        $validated = $this->validateDailyLog($request, $isDraft);
        $issueChallengeType = $validated['issue_challenge_type'] ?? $daily_log->issue_challenge_type ?? 'issue';

        $issueChallengeImagePath = $daily_log->issue_challenge_image_path;

        if ($issueChallengeType !== 'image' && $issueChallengeImagePath) {
            Storage::disk('public')->delete($issueChallengeImagePath);
            $issueChallengeImagePath = null;
        }

        if ($issueChallengeType === 'image' && $request->hasFile('issue_challenge_image')) {
            if ($issueChallengeImagePath) {
                Storage::disk('public')->delete($issueChallengeImagePath);
            }

            $issueChallengeImagePath = $request->file('issue_challenge_image')->store('daily-log-issues', 'public');
        }

        $daily_log->update([
            'day_no' => $validated['day_no'],
            'log_date' => $validated['log_date'],
            'location' => $validated['location'] ?? null,
            'department_unit' => $validated['department_unit'] ?? null,
            'daily_activity' => $validated['daily_activity'] ?? null,
            'knowledge_skill' => $validated['knowledge_skill'] ?? null,
            'tools_technology' => $validated['tools_technology'] ?? null,
            'reflection_solution' => $validated['reflection_solution'] ?? null,
            'status' => $isDraft ? 'draft' : 'completed',
            'issue_challenge_type' => $issueChallengeType,
            'issue_challenge' => $issueChallengeType === 'issue' ? ($validated['issue_challenge'] ?? null) : null,
            'issue_challenge_image_path' => $issueChallengeImagePath,
            'flowchart_steps' => $issueChallengeType === 'flowchart' ? ($validated['flowchart_steps'] ?? null) : null,
        ]);

        return redirect()
            ->route('daily-logs.index')
            ->with('success', $isDraft ? 'Draf laporan berjaya dikemaskini.' : 'Laporan harian berjaya dikemaskini.');
    }

    public function destroy(DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);

        if ($daily_log->issue_challenge_image_path) {
            Storage::disk('public')->delete($daily_log->issue_challenge_image_path);
        }

        $daily_log->delete();

        return redirect()->route('daily-logs.index')->with('success', 'Laporan harian berjaya dipadam.');
    }

    public function viewIssueImage(DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);
        abort_unless($daily_log->issue_challenge_image_path, 404);

        return response()->file(Storage::disk('public')->path($daily_log->issue_challenge_image_path));
    }

    public function downloadIssueImage(DailyLog $daily_log)
    {
        $this->ensureStudentAccess();
        abort_if($daily_log->user_id !== Auth::id(), 403);
        abort_unless($daily_log->issue_challenge_image_path, 404);

        return response()->download(
            Storage::disk('public')->path($daily_log->issue_challenge_image_path),
            'isu-cabaran-'.$daily_log->id.'.'.pathinfo($daily_log->issue_challenge_image_path, PATHINFO_EXTENSION)
        );
    }
}
