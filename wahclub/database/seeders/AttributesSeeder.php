<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['attribute' => 'Social Skills', 'description' => 'The ability to interact harmoniously and effectively with others in diverse settings.'],
            ['attribute' => 'Interpersonal Skills', 'description' => 'Building strong relationships and working well with individuals and teams.'],
            ['attribute' => 'Brand Value/Strong Presence', 'description' => 'Creating a memorable and influential professional or personal reputation.'],
            ['attribute' => 'Communicate Ideas Clearly', 'description' => 'Expressing thoughts and concepts in a way that is easily understood by others.'],
            ['attribute' => 'Presentation Skills', 'description' => 'The capability to effectively convey information and ideas to an audience with confidence and clarity.'],
            ['attribute' => 'Professional Communication', 'description' => 'Mastering formal communication that is clear, respectful, and suited for a business environment.'],
            ['attribute' => 'Inclusive Leadership', 'description' => 'Leading teams with an emphasis on diversity, equity, and inclusion to achieve collective success.'],
            ['attribute' => 'Pragmatic Approach', 'description' => 'Tackling challenges with practical, results-oriented solutions.'],
            ['attribute' => 'Employee Oriented', 'description' => 'Fostering a workplace environment focused on the well-being and development of employees.'],
            ['attribute' => 'Building High Performing Teams', 'description' => 'Creating and nurturing cohesive teams that excel in collaboration and results.'],
            ['attribute' => 'Cognitive Agility', 'description' => 'Quickly adapting to new ideas, problems, or environments while thinking flexibly.'],
            ['attribute' => 'Navigating Changes', 'description' => 'Effectively managing transitions and shifting dynamics within an organization or project.'],
            ['attribute' => 'Innovative Thinking', 'description' => 'Generating creative solutions and pioneering new ideas that drive progress.'],
            ['attribute' => 'Self-Awareness', 'description' => 'Understanding your own strengths, weaknesses, and emotions to enhance personal growth.'],
            ['attribute' => 'Managing Conflict', 'description' => 'Handling disagreements constructively to reach positive resolutions.'],
            ['attribute' => 'Progressive Thinking', 'description' => 'Embracing forward-thinking ideas and advocating for improvement and change.'],
            ['attribute' => 'Conscientiousness', 'description' => 'Being diligent, responsible, and organized in personal and professional tasks.'],
            ['attribute' => 'Overcome Challenges', 'description' => 'Facing obstacles with determination and finding solutions to move forward.'],
            ['attribute' => 'Work-Life Balance', 'description' => 'Striking a healthy equilibrium between professional responsibilities and personal well-being.'],
            ['attribute' => 'Self-Confidence', 'description' => 'Believing in your own abilities and skills to navigate challenges with assurance.'],
            ['attribute' => 'Resilience', 'description' => 'Bouncing back from setbacks and staying determined in the face of adversity.'],
            ['attribute' => 'Growth Mindset', 'description' => 'A belief in continuous learning, self-improvement, and adapting to new opportunities.'],
            ['attribute' => 'Analytical Thinking', 'description' => 'The ability to break down complex information and solve problems through logical reasoning.'],
            ['attribute' => 'Authenticity', 'description' => 'Staying true to your values, beliefs, and identity in all personal and professional interactions.'],
            ['attribute' => 'Networking Skills', 'description' => 'Building and maintaining valuable professional relationships to foster opportunities.'],
            ['attribute' => 'Trustworthy', 'description' => 'Being reliable and demonstrating integrity in your actions and commitments.'],
            ['attribute' => 'Negotiation Skills', 'description' => 'The art of finding mutually beneficial solutions through discussion and compromise.'],
            ['attribute' => 'Creative/Innovative Thinking', 'description' => 'The ability to think outside the box and develop novel ideas or approaches.'],
            ['attribute' => 'Accountability', 'description' => 'Taking responsibility for your actions and commitments, ensuring reliability.'],
            ['attribute' => 'Diversity & Inclusion', 'description' => 'Promoting and respecting differences in identity, thought, and experience to create a richer environment.'],
            ['attribute' => 'Nutrition', 'description' => 'Maintaining a healthy diet to support overall well-being and performance.'],
            ['attribute' => 'Emotional Intelligence', 'description' => 'Recognizing, understanding, and managing your emotions and the emotions of others.'],
            ['attribute' => 'Physical Activity', 'description' => 'Regular exercise to boost physical health and mental clarity.'],
            ['attribute' => 'Stress Management', 'description' => 'Developing coping mechanisms to handle stress effectively and maintain well-being.'],
            ['attribute' => 'Relationship Building', 'description' => 'Cultivating meaningful and enduring connections with others.'],
            ['attribute' => 'Happiness/Positive Attitude', 'description' => 'Fostering an optimistic outlook that contributes to personal fulfillment and workplace morale.'],
        ];

        DB::table('attributes')->insert($attributes);
    }
}
