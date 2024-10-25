# JobScheduler

## Overview
System for managing scheduling process where 
Packets of Jobs are schedule to run on Kubernetes Cluster (Targets).

### Targets
* Have limited Availability
* Can accept Jobs and run them
* There are many of them each identified by unique string

### Jobs
* Can be scheduled to be executed on Target
* Can have preference (TargetPolicy) over Target (any, strict: target_id)
* Can use Resources (key, value pair)
* Can Fail or Succeed a run with a Reason
  * Result can have Artefacts (list of URLs)
* Can be aggregated in a Packet
* Have Owner and Creator
* Have Identity which is a unique String that can be converted to Binary
* Can have multiple Policies on what to do in case of a failure

### Packets
* Aggregate multiple of Jobs
* Have unique binary string as Identity
* Represents conjunction Jobs with Resources

### Resources
* Represents additional configuration parameters in a key-value pair
* Can be Unique - when in use in one job Resource is unavailable for others
* Have unique binary string as Identity

### Orders
* Represents intention of scheduling given Packet
* Have priority (1-100, highest, more important)
* Have Owner (who scheduled them)
* Have Identity (unique binary string)
* Are based on some Packet
* Orders are keeping track of Scheduling progress and status
* Can override default preference of TargetPolicy from Job (TargetPolicyOverride)

### Scheduling Cycle
* Jobs are sent to Target cyclically 
* From list of Jobs waiting to be sent partial list is generated
* This requires complex calculation to chose Jobs based on (CalculationEngine, ExpertSystem)
  * Target Availability
  * Packet Priority
  * TargetPolicy and TargetPolicyOverride
  * 

### Target Fulfilment
* Represents (partial) scheduling of Jobs that are chosen in given Cycle
* There is multiple Fulfilment for each Available Target
* One fulfilment representing one Pod in Target k8s cluster
* TargetFulfilment is keeping track of Pod progress and status

### OrderFulfilment
* Represents (partial) scheduling of Jobs from single Order
* Is used to monitor Order progression and status
* Is used to monitor Job progression and status