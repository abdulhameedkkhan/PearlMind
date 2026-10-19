<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', [
            'members' => TeamMember::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.team.form', [
            'member' => new TeamMember(['sort_order' => (int) TeamMember::max('sort_order') + 1, 'is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateMember($request, true);
        unset($data['photo']);
        $data['photo'] = $this->storePhoto($request);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        TeamMember::query()->create($data);

        return redirect()->route('admin.team.index')->with('status', 'Team member added.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $data = $this->validateMember($request, false);
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $this->deleteUploaded($team->photo);
            $data['photo'] = $this->storePhoto($request);
        }
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $team->update($data);

        return redirect()->route('admin.team.index')->with('status', 'Team member updated.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        $this->deleteUploaded($team->photo);
        $team->delete();

        return redirect()->route('admin.team.index')->with('status', 'Team member removed.');
    }

    private function validateMember(Request $request, bool $photoRequired): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'photo' => [$photoRequired ? 'required' : 'nullable', 'image', 'max:4096'],
        ]);
    }

    private function storePhoto(Request $request): string
    {
        $file = $request->file('photo');
        $dir = public_path('images/team-uploads');
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $name = Str::uuid()->toString().'.'.$file->extension();
        $file->move($dir, $name);

        return '/images/team-uploads/'.$name;
    }

    private function deleteUploaded(?string $path): void
    {
        if ($path && str_starts_with($path, '/images/team-uploads/')) {
            $full = public_path(ltrim($path, '/'));
            if (is_file($full)) {
                unlink($full);
            }
        }
    }
}
