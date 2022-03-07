<?php

namespace App\Tests\Form;

use App\Entity\Flat;
use App\Entity\Partner;
use App\Form\EditFlatType;
use App\Tests\Utils\CreateEntityKernelTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * @internal
 */
class EditFlatTypeTest extends CreateEntityKernelTestCase
{
    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var array */
    private $flatDefaults;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formFactory = self::getContainer()->get(FormFactoryInterface::class);
    }

    protected function tearDown(): void
    {
        $this->formFactory = null;
        $this->flatDefaults = null;

        parent::tearDown();
    }

    /**
     * @dataProvider provideTestSubmitData
     */
    public function testSubmitData()
    {
        $flat = $this->createEntity(Flat::class, []);
        $partner = $this->createEntity(Partner::class, [
            'name' => 'Foo',
        ]);

        $formData = [
            'status' => true,
            'partner' => $partner->getIdPartner(),
        ];

        $form = $this->formFactory->create(EditFlatType::class, $flat, [
            'csrf_protection' => false,
        ]);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isValid());
        $flat = $form->getData();
        $this->assertSame(true, $flat->getStatus());
        $this->assertSame($partner->getIdPartner(), $flat->getPartner()->getIdPartner());

        $view = $form->createView();
        $children = $view->children;

        foreach (\array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function provideTestSubmitData(): \Generator
    {
        for ($a = 0; $a < 100; ++$a) {
            yield [];
        }
    }
}
