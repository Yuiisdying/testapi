import { NextResponse } from 'next/server';

export async function GET() {
  const comments = [
    { id: 1, postId: 1, author: 'User1', text: 'Great post!', likes: 5, date: '2026-01-16' },
    { id: 2, postId: 1, author: 'User2', text: 'Thanks for sharing', likes: 3, date: '2026-01-17' },
    { id: 3, postId: 2, author: 'User3', text: 'Very interesting', likes: 8, date: '2026-02-21' },
    { id: 4, postId: 3, author: 'User4', text: 'Love this content', likes: 12, date: '2026-03-11' },
    { id: 5, postId: 4, author: 'User5', text: 'Helpful info', likes: 7, date: '2026-04-06' },
  ];

  return NextResponse.json(comments);
}
