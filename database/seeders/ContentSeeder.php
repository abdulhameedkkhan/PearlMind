<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        if (TeamMember::query()->doesntExist()) {
            $members = [
                ['Web Design', 'Founder', '/amonx/images/team/team-1-1.jpg'],
                ['Social Media', 'Manager', '/amonx/images/team/team-1-2.jpg'],
                ['App Development', 'Co-Founder', '/amonx/images/team/team-1-3.jpg'],
                ['Software', 'Support', '/amonx/images/team/team-1-4.jpg'],
            ];
            foreach ($members as $i => [$name, $role, $photo]) {
                TeamMember::query()->create([
                    'name' => $name,
                    'role' => $role,
                    'photo' => $photo,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }

        if (Project::query()->doesntExist()) {
            $sites = [
                ['The Mok International', 'https://themokinternational.com', 'Website'],
                ['Electronyat', 'https://electronyat.qa', 'E-commerce'],
                ['Neelam', 'https://neelam.qa', 'Website'],
                ['Shopprve', 'https://shopprve.com', 'E-commerce'],
                ['Sada Beauty Salons', 'https://sadabeautysalons.com', 'Beauty'],
                ['Masterland Qatar', 'https://masterlandqatar.com', 'Website'],
                ['Accentia Consulting', 'https://accentiaconsulting.com', 'Consulting'],
                ['RH Contracting', 'https://rhcontracting.qa', 'Contracting'],
                ['Velvet Glow Salon & Spa Qatar', 'https://velvetglowsalonspaqatar.com', 'Beauty'],
                ['Next Vision Institute', 'https://nextvisioninstitute.com', 'Education'],
                ['Zymal Official', 'https://zymalofficial.com', 'E-commerce'],
                ['Mekarib RK', 'https://mekaribyrk.co', 'Website'],
                ['The Premium Butchers', 'https://thepremiumbutchers.com', 'E-commerce'],
            ];
            foreach ($sites as $i => [$title, $url, $category]) {
                $domain = preg_replace('#^https?://#', '', $url);
                Project::query()->create([
                    'title' => $title,
                    'url' => $url,
                    'category' => $category,
                    'image' => '/images/work/'.$domain.'.jpg',
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
