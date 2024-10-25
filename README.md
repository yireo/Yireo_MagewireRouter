# Yireo MagewireRouter

**This Magento 2 module adds a router specifically for Magewire requests, shaving off various milliseconds off every request.**

## Reasoning
By default, when a request to `magewire/post/livewire` is made, it loops through routers before hitting the `standard` router which maps the URL path to the right controller. This means that with every request, the `securitytxt` router, the `robots` router and the `urlrewrite` router are used. And the `urlrewrite` router adds an additional database query. This module adds a new router with ordering 1, preceeding all others.

## Benchmarks
Simple benchmarking with `time` and `curl` was used to determine the request time of Magewire with this module enabled and with this module disabled:
```bash
time curl -s -H 'Content-Type: application/json' -d '{}' -XPOST -S http://magento.local/default/magewire/post/livewire
```

In my case, without the module, request times are between 165ms and 200ms. With the module enabled, request times are between 155ms and 180ms.
