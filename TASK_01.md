# Send jobs

## Overview
Given that some Order is created, make a request to send some of its Items to Runner
- Only CREATED jobs can be sent
- Runner will accept any number of Items but only first 8 will be executed. The rest will be ignored.

TASK:
- Create PORT for executing Items for given Order
- Create orchestrator that will load Order
- make sure that only jobs that actually was executed will update its state
- add necessary state to Order or Items to make sure that you can keep state consistency
- Make sure that items are executed in order of Priority