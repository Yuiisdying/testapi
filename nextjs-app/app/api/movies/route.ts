import { NextResponse } from 'next/server';

export async function GET() {
  const movies = [
    { id: 1, title: 'Inception', director: 'Christopher Nolan', year: 2010, rating: 8.8, genre: 'Sci-Fi' },
    { id: 2, title: 'The Shawshank Redemption', director: 'Frank Darabont', year: 1994, rating: 9.3, genre: 'Drama' },
    { id: 3, title: 'The Dark Knight', director: 'Christopher Nolan', year: 2008, rating: 9.0, genre: 'Action' },
    { id: 4, title: 'Forrest Gump', director: 'Robert Zemeckis', year: 1994, rating: 8.8, genre: 'Drama' },
    { id: 5, title: 'Interstellar', director: 'Christopher Nolan', year: 2014, rating: 8.6, genre: 'Sci-Fi' },
  ];

  return NextResponse.json(movies);
}
