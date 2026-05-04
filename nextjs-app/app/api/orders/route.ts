import { NextResponse } from 'next/server';

export async function GET() {
  const orders = [
    { id: 1001, userId: 1, total: 1249.98, status: 'delivered', date: '2026-01-10' },
    { id: 1002, userId: 2, total: 429.97, status: 'shipped', date: '2026-02-15' },
    { id: 1003, userId: 3, total: 899.99, status: 'processing', date: '2026-03-20' },
    { id: 1004, userId: 4, total: 149.99, status: 'delivered', date: '2026-04-01' },
    { id: 1005, userId: 5, total: 579.98, status: 'pending', date: '2026-05-02' },
  ];

  return NextResponse.json(orders);
}
