<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Models\Project;
use App\Models\Privatemessage;

class FrontendController extends Controller
{
    public function index()
    {
        return Inertia::render('yousuf-shimul', [
            'canRegister' => Features::enabled(Features::registration()),
            'user' => auth()->user(),
            'profile' => [
                'name'  => 'Yousuf Shimul',
                'email' => 'me@yousuf-shimul.com',
                'phone' => '+880 1992-292589',
                'role'  => 'Laravel [Backend] Developer',
                'description' => 'Specializing in building scalable and high-performance web applications. I have strong expertise in task scheduling, queue job processing, Fixing bugs and seamless third-party API integrations. I focus on writing clean, efficient, and maintainable backend systems that ensure reliability and automation.',
                'resume_url'  => asset('uploads/yousuf-shimul-resume.pdf'),
                'photo_url'   => asset('uploads/shimul.jpeg'),
            ],
            
            'clients' => [
                [
                    'name'    => 'Abdul Alim',
                    'photos'  => asset('uploads/abdul_alim.png'),
                    'company' => 'Founder, SysTech Lab LLC.',
                    'testimonial' => 'I have worked with him for the past three years, and it has been an excellent experience. He is polite, hardworking, and highly professional. He always meets all requirements and delivers quality work on time. I strongly recommend him as a reliable and skilled web developer.',
                ],
                [
                    'name'    => 'Yusuf Jamil',
                    'photos'  => asset('uploads/yusuf_jamil.png'),
                    'company' => 'Founder, MedPro Global Academy.',
                    'testimonial' => 'I am currently working with him on the ongoing MedPro Global project, and it has been a great experience. He is professional, dedicated, and consistently delivers high-quality work on time. I highly recommend him as a reliable and skilled web developer.',
                ],
                [
                    'name'    => 'Sohel Arefin',
                    'photos'  => asset('uploads/sohel_arefin.png'),
                    'company' => 'CEO, CustomPress NYC.',
                    'testimonial' => 'We are very happy with the CustomPress on-demand T-shirt printing and customization platform. The website is easy to use and works smoothly. The product customization and order system are simple and efficient, which helps our business a lot. The project was completed professionally and on time. We highly recommend him as a reliable and skilled developer.',
                ],
            ],
            'projects' => Project::latest()->get([
                'uuid',
                'name',
                'type',
                'github_url',
                'live_url',
                'thumbnail_url',
            ]),
            'github_url'    => 'https://github.com/themespure',
            'linkedin_url'  => 'https://www.linkedin.com/in/yousufshimul/',
            'instagram_url' => 'https://www.instagram.com/yousufshimul.89',
            'facebook_url'  => 'https://www.facebook.com/usfshimul.me',
            
        ]);
    }


    public function project($uuid)
    {
        $data = Project::where('uuid', $uuid)->first() ? Project::where('uuid', $uuid)->first()->toArray() : null;

        // dd($data);
        

        if(!$data)
        {
            return redirect()->back();
        }

        return Inertia::render('ProjectDetails', [
            'project' => $data,
            'thumbnail_url' => $data['thumbnail_url'] ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Sanitize
        $sanitized = [
            'name'    => strip_tags($validated['name']),
            'email'   => filter_var($validated['email'], FILTER_SANITIZE_EMAIL),
            'subject' => strip_tags($validated['subject']),
            'message' => strip_tags($validated['message']),
        ];

        // Save to database or send mail
        Privatemessage::create($sanitized);

        return Inertia::render('Demo', [
            'flash' => [
                'success' => 'Message sent successfully!'
            ]
        ]);
    }
}
