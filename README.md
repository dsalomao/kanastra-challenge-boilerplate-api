# Dasalomao Kanastra Chalenge - (Laravel Back End API)

<!-- PROJECT -->
<br />
<p align="center">

  <img src="https://avatars.githubusercontent.com/u/96804932?s=200&v=4" alt="Logo" width="80" height="80">

  <h3 align="center">Dasalomao Kanastra Chalenge - (Laravel Back End API)</h3>
<br\>
<br\>
<br\>
  <p>
     This application is an API with two end-points beeing:
    <br />
    <br />
  </p>
    <ul>
        <li>A upload csv file.</li>
        <li>Uploaded csv (batch) files list.</li>
    </ul>
    <p>
        It also contains two queueable jobs:
    </p>
    <ul>
        <li>One for processing the uploaded files in batches to a 'files' queue</li>
        <li>Another for using the data saved to the DB from those files to create payment tickets pdfs and send them via emails</li>
    </ul>
</p>

### Installation

1.  Clone the repo
    ```sh
    git clone https://github.com/dsalomao/kanastra-challenge-boilerplate-api.git
    ```
2.  Install the packages

    ```sh
    composer install
    ```

3.  Build Docker Containers

    ```sh
    sail up --build
    ```

    or

    ```sh
    ./vendor/bin/sail up --build
    ```

4.  generate .enb

    ```sh
    create a new .env file based in .env.example
    run php artisan key:generate
    ```

5.  config env variables

    ```sh
    The application uses some environment variables to work properly
    that can be edited for your dev environment:
    - Laravel Sanctum :
    ```

    ```sh
    (these variables coordinate the cors services
    to allow or deny access to the application)
    ```

    ```sh
    (they should reflect your front end and back end domains and ports)
    ```

    ````sh
        - APP_URL=http://localhost:80
        - FRONTEND_URL=http://localhost:8888
        - SANCTUM_STATEFUL_DOMAINS=localhost:8888
        - SESSION_DOMAIN=localhost
    ```
    ````
