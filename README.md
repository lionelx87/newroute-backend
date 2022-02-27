# Run in Laradock

### Enter the container ```workspace``` and execute:
```php artisan serve --host 0.0.0.0 --port 8000``` 
### Obtain the IP of the container using for example the following command:
```hostname -I | awk '{print $1}'```
### On the host computer, in the hosts file add the following:
```172.19.0.5   newroute.backend```
### Finally, run the following command to start the Ionic application:
```ng serve```



