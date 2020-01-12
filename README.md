# sweetspot
SweetSpot dev environment.




## Kuber 

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml"





kubectl create secret docker-registry regcred --docker-server=<your-registry-server> --docker-username=<your-name> --docker-password=<your-pword> --docker-email=<your-email>

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" 


kubectl create secret docker-registry dockerhub --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" --docker-server="docker.io" --docker-username="vrww" --docker-password="rGi&a/yPr8Cy[QBatr2Fg>i9&82xAC" --docker-email="rdurapau@gmail.com"


kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" apply -f kuber/deplyment.yml
kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" exec -ti vrww-55554b9446-kg24r /bin/bash