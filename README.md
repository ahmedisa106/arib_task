## to install the project

### [1]  clone the project via https or ssh 
`git clone https://github.com/ahmedisa106/arib_task.git `
    <p>or</p>
`git clone git@github.com:ahmedisa106/arib_task.git `

### [2]  Go to the project's directory
`cd /var/www/arib_task`

### [3]  Run the following command to copy .env.example file  as .env :
`cp .env.example .env`

### [4]  edit .env file and configure database name,username and password :
### [5]  Run the following commands :

`composer install`
<br>

`php artsian key:generate`
<br>

`php artsian migrate --seed`
<br>

`php artsian jwt:secret`
<br>

`php artsian serve`
