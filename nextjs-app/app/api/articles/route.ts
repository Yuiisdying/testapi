import { NextResponse } from 'next/server';

export async function GET() {
  const articles = [
    { id: 1, title: 'Getting Started with React', author: 'Tech Writer', views: 1250, category: 'Programming' },
    { id: 2, title: 'Web Design Trends 2026', author: 'Design Expert', views: 2840, category: 'Design' },
    { id: 3, title: 'AI and Machine Learning Basics', author: 'AI Specialist', views: 3120, category: 'AI' },
    { id: 4, title: 'Cloud Computing Guide', author: 'DevOps Engineer', views: 1890, category: 'Cloud' },
    { id: 5, title: 'Security Best Practices', author: 'Security Officer', views: 2560, category: 'Security' },
  ];

  return NextResponse.json(articles);
}
