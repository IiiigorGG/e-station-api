# E-station API

This is a basic REST api for charging station service. I followed laravel structure so entire app is contained in `app` folder, test in `test` folder and docker instructions in `Dockerfile` and `docker-compose.yml` files.

## Extended version

I decide to improve basic api for a bit and added some featured which you can find on `extended` branch.

# Installation

## Build docker image

    docker-compose build

## Run the app

You can run api with docker and manually

#### Run with docker

    docker-compose up

#### Run manually

    php artisan serve

## Run tests

    php  artisan test

# Usage

Api security is very important part of project, so I decided to add Passport authentication, using token to identify authenticated users. All routs connected to authentication are prefixed with  `/auth`.  

You have to pass token as query parameter each request to create, receive or update e-stations data.

## Registration

First, you have to register new user. In response, you'll get information about success or error message. 

#### Request

    POST http://example/auth/register   
    
    {
      name: <yourName>,
      email: <yourEmail>,
      password: <yourPassword>,
      confirm_password: <yourPassword>
    }

#### Response

    Status: 201 Created
    Body: {
      message: `Successfully created user!`
    }
    
## Login

After registration, you can log in application and receive personal api token. 

If you forgot your token, you can just log in again and get new valid token.

#### Request

    POST http://example/auth/login   

    {
      email: <yourEmail>,
      password: <yourPassword>
    }

#### Response

    Status: 200 OK
    Body: {
      token: <yourApiToken>
    }
    
## Logout

To delete all your tokens you can log out. Your user won't be deleted during logging out.

#### Request

    GET http://example/auth/logout

##### Options  
- token
   - `yourApiToken`
    

#### Response

    Status: 200 OK
    Body: {
      message: 'Successfully logged out!'
    }

## Get profile info

#### Request

    GET http://example/auth/user

##### Options  
- token
   - `yourApiToken`
    

#### Response

    Status: 200 OK
    Body: {
      user: `userObject`
    }


## Create e-station

#### Request

    POST http://example/stations

    {
      city: `Example city`,
      position:{
        latitude: `Example latitude`,
        longitude: `Example longitude`,
      }
    }

#### Response

    Status: 201 Created
    {
      station: `station object`
    }

## Get stations

#### Request

    GET http://example/stations

##### Options  
- status 
    - `open`
    - `close`
- city 
    - `cityName`

#### Response

    Status: 200 OK
    Body: {
      stations: [
          `stationObject`,
          `stationObject`
           ...
      ]
    }

## Get closest e-station
    
In basic api I chose direct distance to calculate closest e-station but it isn't good enough. Here I also used `Google Maps Direction Api` to get route time and distance estimates so user can chose the best way.

#### Request

    GET http://example/stations/closest

##### Options  
- status 
    - `open`
    - `close`
- measure (`default` = `direct_distance`)
    - `direct_distance`
    - `route_length`
    - `time_spent`
- position 
    - LatLon formated to `<latitude>.<longitude>`
   
#### Response

    Status: 200 OK
    Body: {
      distance: {
        text : `<distance string>`,
        value : `<time in meters>`
      },
      duration: {
        text : `<time string>`,
        value : `<time in miliseconds>`
      },
      station: `station object`
    }

## Update e-station

#### Request

    PUT http://example/stations

    {
      status: <open|close>
      city: <ExampleCity>,
      position:{
        latitude: <ExampleLatitude>,
        longitude: <ExampleLongitude>,
      }
    }

#### Response

    Status: 204 No Content
    
 ## Delete e-station
 
 #### Request
 
     `DELETE` http://example/stations/{id}
     
 
 #### Response
 
     Status: 204 No Content
