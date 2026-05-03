import { NextResponse } from 'next/server';

export async function GET() {
  const recipes = [
    { id: 1, name: 'Pasta Carbonara', cuisine: 'Italian', prepTime: 20, difficulty: 'Easy' },
    { id: 2, name: 'Pad Thai', cuisine: 'Thai', prepTime: 30, difficulty: 'Medium' },
    { id: 3, name: 'Beef Tacos', cuisine: 'Mexican', prepTime: 25, difficulty: 'Easy' },
    { id: 4, name: 'Sushi Rolls', cuisine: 'Japanese', prepTime: 45, difficulty: 'Hard' },
    { id: 5, name: 'Chicken Tikka Masala', cuisine: 'Indian', prepTime: 60, difficulty: 'Medium' },
  ];

  return NextResponse.json(recipes);
}
