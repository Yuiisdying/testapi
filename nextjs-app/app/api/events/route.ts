import { NextResponse } from 'next/server';

export async function GET() {
  const events = [
    { id: 1, name: 'Tech Conference 2026', date: '2026-06-15', location: 'San Francisco', attendees: 5000 },
    { id: 2, name: 'Web Summit', date: '2026-07-20', location: 'Lisboa', attendees: 7000 },
    { id: 3, name: 'AI Workshop', date: '2026-05-30', location: 'Berlin', attendees: 200 },
    { id: 4, name: 'Design Expo', date: '2026-08-10', location: 'New York', attendees: 3000 },
    { id: 5, name: 'Developer Meetup', date: '2026-05-25', location: 'Tokyo', attendees: 150 },
  ];

  return NextResponse.json(events);
}
