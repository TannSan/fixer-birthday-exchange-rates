# fixer-birthday-exchange-rates
This example PHP Laravel appliction uses Guzzle to connect to the Fixer Exchange Rates API to retrieve the EUR to SEK exchange rate for the selected birthday date.  [Click here to see the live demo of this project.](https://fber.ninethree.co.uk/)

**Requires PHP 7.1.3 or greater.**

There is a free tier to the Fixer API but it does require registration: https://fixer.io


## Installation
1. Clone this repository: `git clone https://github.com/TannSan/fixer-birthday-exchange-rates.git`
2. Create your `.env` file in the project root. There is a template file included called `.env.example` which you can rename
3. Set your Fixer API key in the `.env` file. (You get it on the Fixer website after you create your account)
4. Download dependancies: `composer update`


## Usage
Select a date from the calendar and click the big blue button.  The selected date will be added to the table below along with the exchange rate.  If the birthday already exists then the little green badge indicator is updated to reflect the number of times this date has been queried.  Dates must be within the past year and they can not be in the future.


## Dependencies
* [Fixer.io](https://fixer.io)
* [guzzlehttp/guzzle v6](http://docs.guzzlephp.org)
* [alcohol/iso4217](https://github.com/alcohol/iso4217)
* [OzyAst's Hullabaloo](https://github.com/OzyAst/Hullabaloo)


## Future Improvements
* Searching Indicator
* Show Fixer Remaining Usage Count
* Results Table Paging
* Add Localisation
* Show Progress Indicator