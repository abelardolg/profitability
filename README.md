# Profitability
## What are doing this project?
It takes several projects with these pieces of information:
  * name;
  * start date;
  * finish date;
  * profitability;
  
and it analyzes what is the best roadmap (combination of projects) to get the best profitability of them.
## Constraints:
  * A project should run per time. Overlapped projects are not considered.
  * When a project finishes a day, another project could run with 100% of the available resources that same day.

## How to run it:
Follow these steps to run this project:
* Go to root folder of this project;
* Run the following command:
  * Under Linux/OS: ```php ./src/ProfitabilityApp```
  * Under Windows: ```php /src/ProfitabilityApp```

Happy run! :)

## Improvements
The following improvements could be applied to this project:
* By using a graph with deep-first search would be more efficient;
* Currently, the complexity of this algorithm is O(N^2) in all cases (best, middle and worst cases):
  * By using recursion instead of current iterative approach the complexity of these algorithms could be dramatically decreased.
* Several pieces of this chain could be named more precise than used ones.
* By adding logs could be handy in order to obtain valuable information about the process.

## Tests
To run the tests, please execute the following command under the root dir:
* ``` php ./vendor/bin/phpunit --verbose tests ```