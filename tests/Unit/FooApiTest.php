<?php

namespace App\Tests\Unit;

use App\Entity\Foo;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class FooApiTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        $foos = static::createClient()->request('GET', '/api/foos', [
            'headers' => ['accept' => 'application/ld+json'],
            'query' => ['itemsPerPage' => '5'],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );
        $this->assertCount(5, $foos->toArray()['hydra:member']);
        $this->assertEquals(11, $foos->toArray()['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Foo::class);
    }

    public function testPost(): void
    {
        static::createClient()->request('POST', '/api/foos', ['json' => [
            'code' => 'test code',
            'label' => 'test label',
        ]]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
    }

    public function testDelete(): void
    {
        $foos = static::createClient()->request('GET', '/api/foos', ['headers' => ['accept' => 'application/json']]);
        $foo = json_decode($foos->getContent())[0];

        static::createClient()->request('DELETE', '/api/foos/'.$foo->id);
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(204);
    }

    public function testGetCollectionWithFilters(): void
    {
        $foos = static::createClient()->request('GET', '/api/foos', [
            'query' => ['code' => 'TST'],
            'headers' => ['accept' => 'application/json'],
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            [
                'code' => 'TST',
                'label' => 'foo test',
            ],
        ]);
    }
}