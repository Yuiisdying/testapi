import { NextResponse } from 'next/server';

export async function GET() {
  const songs = [
    { id: 1, title: 'Bohemian Rhapsody', artist: 'Queen', album: 'A Night at the Opera', year: 1975, duration: '5:55' },
    { id: 2, title: 'Imagine', artist: 'John Lennon', album: 'Imagine', year: 1971, duration: '3:03' },
    { id: 3, title: 'Hotel California', artist: 'Eagles', album: 'Hotel California', year: 1976, duration: '6:30' },
    { id: 4, title: 'Stairway to Heaven', artist: 'Led Zeppelin', album: 'Led Zeppelin IV', year: 1971, duration: '8:02' },
    { id: 5, title: 'Like a Rolling Stone', artist: 'Bob Dylan', album: 'Highway 61 Revisited', year: 1965, duration: '6:13' },
  ];

  return NextResponse.json(songs);
}
