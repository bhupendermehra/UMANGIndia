<?php

namespace App\Services;

class SeoService
{
    public static function schemeSchema($scheme): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'GovernmentService',
            'name' => $scheme->title,
            'description' => $scheme->short_description,
            'url' => url()->current(),
            'provider' => [
                '@type' => 'GovernmentOrganization',
                'name' => 'Government of India',
                'url' => 'https://www.india.gov.in',
            ],
            'serviceType' => $scheme->category->name ?? '',
            'areaServed' => ['@type' => 'Country', 'name' => 'India'],
        ];
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public static function breadcrumbSchema(array $items): string
    {
        $elements = [];
        foreach ($items as $i => $item) {
            $elements[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['label'],
                'item' => $item['url'],
            ];
        }
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $elements,
        ];
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}