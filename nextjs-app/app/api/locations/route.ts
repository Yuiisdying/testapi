import { NextResponse } from 'next/server';

export async function GET() {
  const locations = [
    { id: 1, name: 'Central Park', city: 'New York', latitude: 40.7829, longitude: -73.9654, type: 'Park' },
    { id: 2, name: 'Eiffel Tower', city: 'Paris', latitude: 48.8584, longitude: 2.2945, type: 'Monument' },
    { id: 3, name: 'Big Ben', city: 'London', latitude: 51.4975, longitude: -0.1247, type: 'Monument' },
    { id: 4, name: 'Mount Fuji', city: 'Tokyo', latitude: 35.3606, longitude: 138.7274, type: 'Mountain' },
    { id: 5, name: 'Statue of Liberty', city: 'New York', latitude: 40.6892, longitude: -74.0445, type: 'Monument' },
  ];

  return NextResponse.json(locations);
}
