**JSON RPC bundle**

1) Add to your AppKernel string "new Lv\RpcBundle\RpcBundle()"
2) Add to your routing.yml 
    rpc:
        resource: "@Lv/RpcBundle/Controller/"
        type:     annotation
        prefix:   /
3) Add to your config.yml  
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