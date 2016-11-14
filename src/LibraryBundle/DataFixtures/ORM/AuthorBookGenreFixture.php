<?php

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lv\LibraryBundle\Entity\Author;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lv\LibraryBundle\Entity\Genre;
use Lv\LibraryBundle\Entity\Book;

class AuthorBookGenreFixture extends AbstractFixture implements OrderedFixtureInterface, \Symfony\Component\DependencyInjection\ContainerAwareInterface
{
    use \Symfony\Component\DependencyInjection\ContainerAwareTrait;
    /**
     * @var ContainerInterface
     */
    protected $container;


    public $fairyTale = 'Сказки';
    public $fiction = 'Художественная литература';
    public $novel = 'Роман';
    public $philosophicalNovel = 'Философский роман';
    public $classicLiterature = 'Классическая литература';
    public $classicalModernProse = 'Классическая и современная проза';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('ru_RU');
        //genres
        foreach($this->getGenres() as $genre){
            $g = new Genre();
            $g->setName($genre['name']);
            $g->setAlias($genre['alias']);

            $manager->persist($g);
        }
        $manager->flush();

        $genreRp = $manager->getRepository('LvLibraryBundle:Genre');
        //author with books
        foreach($this->getAuthorsWithBook() as  $author => $books){
            $a = new Author();
            $a->setName($author);
            $manager->persist($a);
            $manager->flush();
            foreach($books as $book){
                $b = new Book();
                $b->setName($book['name']);
                $b->setAuthor($a);
                $b->setCountPages($book['countPages']);
                $b->setYear($book['year']);
                foreach ($book['genres'] as $genre){
                    if($g = $genreRp->findOneBy(['alias' => $genre])){
                        $b->addBookGenre($g);
                    }
                }
                $manager->persist($b);
            }
            $manager->flush();
            for($f = 0; $f < 10; $f++){
                $b = new Book();
                $b->setName('Фейк-Книга_' . $faker->firstName);
                $b->setAuthor($a);
                $b->setCountPages($f + mt_rand(10, 200));
                $b->setYear($faker->year);
                $b->addBookGenre($genreRp->findAll()[mt_rand(1,5)]);

                $manager->persist($b);
            }
            $manager->flush();

        }
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

    protected function getGenres(){

        $sluglify = $this->container->get('slugify');

        return [
            [
                'name' => $this->fairyTale,
                'alias' => $sluglify->slugify($this->fairyTale),
            ],
            [
                'name' => $this->fiction,
                'alias' => $sluglify->slugify($this->fiction),
            ],
            [
                'name' => $this->philosophicalNovel,
                'alias' => $sluglify->slugify($this->philosophicalNovel),
            ],
            [
                'name' => $this->classicLiterature,
                'alias' => $sluglify->slugify($this->classicLiterature),
            ],
            [
                'name' => $this->novel,
                'alias' => $sluglify->slugify($this->novel),
            ],
            [
                'name' => $this->classicalModernProse,
                'alias' => $sluglify->slugify($this->classicalModernProse),
            ],
        ];
    }

    protected function getAuthorsWithBook(){

        $sluglify = $this->container->get('slugify');

        return [
            'Владимир Даль' =>[
                [
                    'name'        => 'Русские народные сказки',
                    'year' => '2012',
                    'countPages'  => '120',
                    'genres'      => [
                        $sluglify->slugify($this->fairyTale),
                    ]
                ],
                [
                    'name'        => 'Городок в табакерке: сказки русских писателей',
                    'year' => '2009',
                    'countPages'  => '476',
                    'genres'      => [
                        $sluglify->slugify($this->fiction),
                    ]
                ],
                [
                    'name'        => 'Беглянка',
                    'year' => '2010',
                    'countPages'  => '448',
                    'genres'      => [
                        $sluglify->slugify($this->fairyTale),
                    ]
                ],
            ],
            'Фёдор Достоевский'=>[
                [
                    'name'        => 'Братья Карамазовы',
                    'year' => '2016',
                    'countPages'  => '800',
                    'genres'      => [
                        $sluglify->slugify($this->philosophicalNovel),
                    ]
                ],
                [
                    'name' => 'Идиот',
                    'year' => '2016',
                    'countPages'  => '576',
                    'genres'      => [
                        $sluglify->slugify($this->philosophicalNovel),
                        $sluglify->slugify($this->classicLiterature),
                    ]
                ],
                [
                    'name' => 'Преступление и наказание',
                    'year' => '2016',
                    'countPages'  => '480',
                    'genres'      => [
                        $sluglify->slugify($this->philosophicalNovel),
                        $sluglify->slugify($this->classicLiterature),
                    ]
                ],
            ],
            'Стефан Цвейг'=>[
                [
                    'name'        => 'Нетерпение сердца',
                    'year' => '2016',
                    'countPages'  => '800',
                    'genres'      => [
                        $sluglify->slugify($this->novel),
                    ]
                ],
                [
                    'name' => 'Письмо незнакомки',
                    'year' => '2008',
                    'countPages'  => '208',
                    'genres'      => [
                        $sluglify->slugify($this->classicalModernProse)
                    ]
                ],
                [
                    'name' => 'Новеллы',
                    'year' => '2010',
                    'countPages'  => '446',
                    'genres'      => [
                        $sluglify->slugify($this->novel),
                    ]
                ],
            ],
        ];
    }
}