@extends('layouts.app')

@section('slides')
    @foreach($menu as $item)
        @include('sections.'.$item['id'])
    @endforeach
@endsection

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'Person',
    'name'        => $profile['name'],
    'jobTitle'    => $profile['title'],
    'email'       => 'mailto:'.$contact['email'],
    'url'         => url('/'),
    'image'       => asset($profile['images']['hero']),
    'address'     => ['@type' => 'PostalAddress', 'addressLocality' => 'Hyderabad', 'addressCountry' => 'IN'],
    'sameAs'      => array_column($social, 'url'),
    'knowsAbout'  => array_column($skills, 'name'),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush
