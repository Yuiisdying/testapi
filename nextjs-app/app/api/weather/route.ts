import { NextResponse } from 'next/server';

export async function GET() {
  const weather = [
    { city: 'New York', temp: 72, condition: 'Sunny', humidity: 45, windSpeed: 10 },
    { city: 'Los Angeles', temp: 85, condition: 'Clear', humidity: 35, windSpeed: 8 },
    { city: 'London', temp: 65, condition: 'Rainy', humidity: 75, windSpeed: 15 },
    { city: 'Tokyo', temp: 78, condition: 'Cloudy', humidity: 60, windSpeed: 12 },
    { city: 'Paris', temp: 70, condition: 'Partly Cloudy', humidity: 55, windSpeed: 9 },
  ];

  return NextResponse.json(weather);
}
