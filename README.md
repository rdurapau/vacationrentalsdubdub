# sweetspot
SweetSpot dev environment.




## Kuber 

kubectl create secret docker-registry regcred --docker-server=<your-registry-server> --docker-username=<your-name> --docker-password=<your-pword> --docker-email=<your-email>

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" get pods

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" apply -f kuber/deplyment.yml

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" exec -ti vrww-55554b9446-xwj9j /bin/bash

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" rollout restart deployment/vrww

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" describe pod vrww-6c45fcfc68-xftgb
