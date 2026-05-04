import { NextResponse } from 'next/server';

export async function GET() {
  const posts = [
    { id: 1, title: 'First Post', content: 'This is the first post', author: 'John', likes: 42, date: '2026-01-15' },
    { id: 2, title: 'Second Post', content: 'Another great post here', author: 'Jane', likes: 67, date: '2026-02-20' },
    { id: 3, title: 'Third Post', content: 'Check out this amazing content', author: 'Bob', likes: 23, date: '2026-03-10' },
    { id: 4, title: 'Fourth Post', content: 'New ideas and thoughts', author: 'Alice', likes: 89, date: '2026-04-05' },
    { id: 5, title: 'Fifth Post', content: 'Latest updates and news', author: 'Charlie', likes: 56, date: '2026-05-01' },
  ];

  return NextResponse.json(posts);
}
