# Sample PHP Vulnerable App

A sample PHP web application with intentionally vulnerable transitive dependencies for SCA testing.

## Vulnerable Dependencies

This project uses older versions of popular packages that have known vulnerable transitive dependencies:

| Package | Version | Notes |
|---------|---------|-------|
| guzzlehttp/guzzle | 6.5.0 | Vulnerable transitive deps in psr7, promises |
| symfony/http-foundation | 4.4.0 | Early 4.4.x has CVEs |
| doctrine/dbal | 2.10.0 | Has vulnerable cache dependencies |
| monolog/monolog | 1.25.0 | Older version with issues |
| twig/twig | 2.12.0 | Has sandbox bypass vulnerabilities |
| phpmailer/phpmailer | 6.0.0 | Early 6.x has RCE issues |
| league/flysystem | 1.0.50 | Has path traversal in adapters |

## Setup

```bash
composer install
```

## Running

```bash
php -S localhost:8080 -t public
```

## Purpose

This application is designed for testing Software Composition Analysis (SCA) tools to verify detection of vulnerabilities in transitive dependencies.
