import { NextResponse } from 'next/server';

export async function GET() {
  const books = [
    { id: 1, title: 'The Great Gatsby', author: 'F. Scott Fitzgerald', year: 1925, rating: 4.5 },
    { id: 2, title: 'To Kill a Mockingbird', author: 'Harper Lee', year: 1960, rating: 4.8 },
    { id: 3, title: '1984', author: 'George Orwell', year: 1949, rating: 4.7 },
    { id: 4, title: 'Pride and Prejudice', author: 'Jane Austen', year: 1813, rating: 4.6 },
    { id: 5, title: 'The Catcher in the Rye', author: 'J.D. Salinger', year: 1951, rating: 4.3 },
  ];

  return NextResponse.json(books);
}
