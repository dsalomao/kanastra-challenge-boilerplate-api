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
    ```

    ```
    - Laravel Sanctum :
        (these variables coordinate the cors services to allow or deny access to the application)
        (they should reflect your front end and back end domains and ports)

        - APP_URL=http://localhost:80
        - FRONTEND_URL=http://localhost:8888
        - SANCTUM_STATEFUL_DOMAINS=localhost:8888
        - SESSION_DOMAIN=localhost
    ```

    ```sh
    - DB connection:
        The default we use here is for the sail docker container

        - DB_CONNECTION=mysql
        - DB_HOST=mysql
        - DB_PORT=3306
        - DB_DATABASE=kanastra
        - DB_USERNAME=root
        - DB_PASSWORD=password
    ```

    ```sh
    - Mailtrap:
        (For testing the ProcessTickets Job)

        - MAIL_MAILER=smtp
        - MAIL_HOST=sandbox.smtp.mailtrap.io
        - MAIL_PORT=2525
        - MAIL_USERNAME=your_mailtrap_account_info
        - MAIL_PASSWORD=your_mailtrap_account_info
        - MAIL_ENCRYPTION=null
        - MAIL_FROM_ADDRESS="dsalomao@kanastratest.com"
        - MAIL_FROM_NAME="${APP_NAME}"
    ```

6.  Migrate Database

    ```sh
    Migrate the database inside sail container
    ```

    ```sh
    sail artisan migrate
    ```

    or

    ```sh
    ./vendor/bin/sail artisan migrate
    ```
