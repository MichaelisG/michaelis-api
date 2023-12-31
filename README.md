# A basic API

## based on Symfony+APIPlatform

### Installation

Create porject:
>`composer create-project symfony-skeleton <name>`

Install development dependencies:
>`composer require --dev maker-bundle profiler phpunit alice symfony/test-pack symfony/http-client justinrainbow/json-schema`

Install runtime dependencies:
>`composer require orm api`

Setup the application:
 - See `config/packages/api_platform.yaml` for resources setup
 - See `config/packages/framwork.yaml` for serialization setup
 - See `config/services.yaml` for filter setup

Api setup is split in 3 files per entities:
 - `config/api/resources/foo.yaml`
 - `config/api/serialization/foo.yaml`
 - `config/api/filters/foo.yaml`

Use `.env.local` & `.env.test` for development & testing purposes.
> at least setup DATABASE_URL

Doctrine:
 - use `bin/console --env=test ...` to interact with test database (migrations & fixtures)
 - use `bin/console ...` to interact with dev database (migrations & fixtures)
 - default configuration suffix test database with _test

Tests:

Load data to test:
> `bin/console --env=test hautelook:fixtures:load`

Launch the tests:
> `bin/phpunit`

Check `tests/Unit/FooApiTest.php` for examples.
