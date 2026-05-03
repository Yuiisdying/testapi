import { NextResponse } from 'next/server';

export async function GET() {
  const products = [
    { id: 1, name: 'Laptop', price: 999.99, category: 'Electronics', stock: 15 },
    { id: 2, name: 'Headphones', price: 149.99, category: 'Electronics', stock: 45 },
    { id: 3, name: 'Desk Chair', price: 299.99, category: 'Furniture', stock: 8 },
    { id: 4, name: 'Monitor', price: 349.99, category: 'Electronics', stock: 22 },
    { id: 5, name: 'Keyboard', price: 79.99, category: 'Electronics', stock: 60 },
  ];

  return NextResponse.json(products);
}
