
#E-station API

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

#### Request

    GET http://example/stations/closest

##### Options  
- status
    - `open`
    - `close`
- measure (`default` = `direct_distance`)
    - `direct_distance`

- position
    - LatLon formated to `<latitude>.<longitude>`

#### Response

    Status: 200 OK
    Body: {
      measure: `requestMeasure`,
      value: `resultValue`,
      station: `stationObject`
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
