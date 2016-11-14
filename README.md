This package was made for fonemica.ru in order to pass the test task and result of the assessment of this package to start working with fonemica.ru.

1) Installing composer require lvovgeka/lib-test-work

2) Registr new bandle 
  - new Lv\RpcBundle\RpcBundle(),
  - new Lv\LibraryBundle\LvLibraryBundle()

3) Setting Rpc server (jsonrpc 2.0)

    
    1) Add to your routing.yml 
        rpc:
            resource: "@Lv/RpcBundle/Controller/"
            type:     annotation
            prefix:   /       
    2) Add to your config.yml
        rpc: 
            mapping:
                - "@YourBundle/Method" 
            cache:
                driver: file    
        For dev env: 
        rpc: 
            mapping: ~
            cache:
                 driver: file
                 kk             
                     
                     
4) Update DB :  php bin/console doctrine:schema:update -f
6) Add to you parameters 'lib_api_url' parameter, example: http://api-lib.you-site.com
5) Seeding data to db php bin/console doctrine:fixtures:load
6) If wont see all rpc method run command:  php bin/console debug:rpc:methods

Rus:


1) Спроектируйте блоки API со стороны каждой библиотеки, как она будет сообщать какие книги были взяты и какими читателями
  - метод: 
     libs.%суда город подставляем%.getStatisticsBooksOnHand пример:  libs.moskva.getStatisticsBooksOnHand 



2) Спроектируйте блоки API со стороны централизированного хранилища, которые будут:
  -  а) получать данные от библиотек о том, какие читатели каакие книги брали и сдавали и когда - метод: centralizedRepository.getStatisticsBooksOnHand 
  -  б) выдавать данные о читателях, сколько у него книг на руках и генерировать произвольные отчеты по имени - метод: centralizedRepository.getStatisticsBooksOnHandForCustomerName

Все методы с параметрами можно посмотреть в rpc-methods.jpg
  
Тесты написаны только для rpc-server. rpc-client нет.
