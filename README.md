# sweetspot
SweetSpot dev environment.




## Kuber 

kubectl create secret docker-registry dockerhub --docker-server="docker.io" --docker-username="vrww" --docker-password="" --docker-email="rdurapau@gmail.com"

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" get pods

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" apply -f kuber/deplyment.yml

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" exec -ti vrww-55554b9446-xwj9j /bin/bash

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" rollout restart deployment/vrww

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" delete service/vrwww-load-balancer

kubectl --kubeconfig="/Users/anthonybudd/.kube/vrww-kubeconfig.yaml" describe pod vrww-6c45fcfc68-xftgb


certbot certonly \
    --manual \
    --preferred-challenges=dns \
    --email anthonybudd94@gmail.com \
    --config-dir . \
    --work-dir . \
    -d vrww.app


    