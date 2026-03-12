<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'MedPro Global',
                'type' => 'Nursing course management application',
                'build_tags' => 'Laravel, livewire, Tailwind CSS, MYSQL',
                'thumbnail_url' => 'uploads/projects/medpro-global.png',
                'feature_images' => [
                    '/images/projects/ecommerce/1.png',
                    '/images/projects/ecommerce/2.png',
                    '/images/projects/ecommerce/3.png',
                ],
                'github_url' => '',
                'live_url' => 'https://medproglob.com',
                'overview' => 'MedPro is a modern nursing course management application built with Laravel and Livewire, designed to empower nursing students with structured digital learning.

It is a complete course-selling platform where students can purchase professional medical skill development courses through a secure online payment system.

The platform features a personalized student dashboard where learners can track their enrolled courses, progress, and class schedules.

Each course is organized into lessons and topics, including both recorded video sessions and live interactive classes for real-time learning.

MedPro ensures a seamless educational experience with dynamic content updates, progress tracking, and a user-friendly interface tailored for future healthcare professionals.',
                'features' => 'Responsive design, interactive elements, project showcase, Tailwind CSS, personalized student dashboard, secure online payment system, dynamic content updates, student My Courses section, progress tracking, class scheduling, recorded video sessions, live interactive classes.',
                'technology_used' => 'Laravel Framework, Livewire v3, Tailwind CSS, MYSQL, JavaScript, Ajax',
                'future_improvement' => 'add multiple payment gateway, add more interactive elements, add more project showcase.',
            ],
            [
                'name' => 'Custom Print',
                'type' => 'Ondemand Tshirt Printing application',
                'build_tags' => 'Laravel, livewire, Tailwind CSS, mySQL',
                'thumbnail_url' => 'uploads/projects/custom-print-thumbnails.png',
                'feature_images' => [
                    '/images/projects/portfolio/1.png',
                    '/images/projects/portfolio/2.png',
                    '/images/projects/portfolio/3.png',
                ],
                'github_url' => '',
                'live_url' => 'https://custompressnyc.com',
                'overview' => 'A custom T-shirt printing application built with Laravel and Livewire, allowing customers to personalize front and back prints, choose from 50+ color options, select multiple sizes per order, and earn through an integrated affiliate promotion system.',
                'features' => 'Responsive design, interactive elements, project showcase, Tailwind CSS, affiliate promotion system, multiple color and size options, Login with google, PayPal Checkout, Card Payment',
                'technology_used' => 'Laravel Framework, Livewire v3, Tailwind CSS, MYSQL, JavaScript, Ajax, PayPal API',
                'future_improvement' => 'add multiple payment gateway, add more interactive elements, add more project showcase.',
            ],
            [
                'name' => 'Fast Inbox',
                'type' => 'sms/email marketing application',
                'build_tags' => 'Laravel, livewire, Bootstrap CSS, MYSQL, Telnyx api, Twilio api, Sendmail',
                'thumbnail_url' => 'uploads/projects/Fast-inbox.jpeg',
                'feature_images' => [
                    '/images/projects/ecommerce/1.png',
                    '/images/projects/ecommerce/2.png',
                    '/images/projects/ecommerce/3.png',
                ],
                'github_url' => '',
                'live_url' => 'https://fastinbox.themespure.com',
                'overview' => 'A single-vendor marketing platform developed using Laravel and Livewire, enabling administrators to manage customer lists, schedule SMS and email campaigns, track performance metrics, and control all operations from one secure admin panel.',
                'features' => 'Responsive design, interactive elements, Bootstrap Included, Material Design Icons, project showcase, Third party api used, Cron job for scheduling.',
                'technology_used' => 'Laravel Framework v11, livewire 3, Bootstrap CSS, Ajax, MYSQL, Telnyx api, Twilio api, Sendmail',
                'future_improvement' => 'add multiple payment gateway, add more interactive elements, add more project showcase.',
            ],
            
        ];

        foreach ($datas as $data) {
            Project::create($data);
        }
    }
}
