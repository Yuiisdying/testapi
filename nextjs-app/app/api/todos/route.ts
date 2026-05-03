import { NextResponse } from 'next/server';

export async function GET() {
  const todos = [
    { id: 1, title: 'Complete project', completed: false, priority: 'high', dueDate: '2026-05-10' },
    { id: 2, title: 'Review code', completed: true, priority: 'medium', dueDate: '2026-05-05' },
    { id: 3, title: 'Write documentation', completed: false, priority: 'medium', dueDate: '2026-05-15' },
    { id: 4, title: 'Fix bugs', completed: false, priority: 'high', dueDate: '2026-05-08' },
    { id: 5, title: 'Deploy to production', completed: true, priority: 'high', dueDate: '2026-04-30' },
  ];

  return NextResponse.json(todos);
}
