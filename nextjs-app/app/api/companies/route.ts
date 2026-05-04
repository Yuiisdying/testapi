import { NextResponse } from 'next/server';

export async function GET() {
  const companies = [
    { id: 1, name: 'Tech Corp', industry: 'Technology', employees: 5000, founded: 1998 },
    { id: 2, name: 'Global Finance', industry: 'Finance', employees: 3500, founded: 1985 },
    { id: 3, name: 'Green Energy', industry: 'Energy', employees: 2200, founded: 2010 },
    { id: 4, name: 'Health Plus', industry: 'Healthcare', employees: 4800, founded: 2005 },
    { id: 5, name: 'Smart Retail', industry: 'Retail', employees: 1500, founded: 2015 },
  ];

  return NextResponse.json(companies);
}
