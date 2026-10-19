<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.portfolio.index', [
            'projects' => Project::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.portfolio.form', [
            'project' => new Project([
                'sort_order' => (int) Project::max('sort_order') + 1,
                'is_active' => true,
                'category' => 'Website',
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProject($request, true);
        unset($data['image']);
        $data['image'] = $this->storeImage($request);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['url'] = $this->normalizeUrl($data['url']);
        Project::query()->create($data);

        return redirect()->route('admin.portfolio')->with('status', 'Portfolio item added.');
    }

    public function edit(Project $project): View
    {
        return view('admin.portfolio.form', ['project' => $project]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validateProject($request, false);
        unset($data['image']);
        $data['url'] = $this->normalizeUrl($data['url']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if ($request->hasFile('image')) {
            $this->deleteUploaded($project->image);
            $data['image'] = $this->storeImage($request);
        }
        $project->update($data);

        return redirect()->route('admin.portfolio')->with('status', 'Portfolio item updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteUploaded($project->image);
        $project->delete();

        return redirect()->route('admin.portfolio')->with('status', 'Portfolio item removed.');
    }

    private function validateProject(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'url' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:80'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);
    }

    private function normalizeUrl(string $url): string
    {
        $url = trim($url);
        if (! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
            $url = 'https://'.$url;
        }

        return $url;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $dir = public_path('images/portfolio');
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $name = Str::uuid()->toString().'.'.$file->extension();
        $file->move($dir, $name);

        return '/images/portfolio/'.$name;
    }

    private function deleteUploaded(?string $path): void
    {
        if ($path && str_starts_with($path, '/images/portfolio/')) {
            $full = public_path(ltrim($path, '/'));
            if (is_file($full)) {
                unlink($full);
            }
        }
    }
}
