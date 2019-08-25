# Rancher Scale Tester

This container is useful to check scale functionality of [Rancher](http://rancher.com/rancher/).   

No need for extra configuration, just create a new service with this image and point to port 80.   
The container will give you info about:   
- Container name (generated from rancher, not the container ID)
- Service name
- Host name (declared in rancher, not the default hostname of the server)

This container works only in a Rancher environment using the [metadata service](https://docs.rancher.com/rancher/v1.5/en/rancher-services/metadata-service/).   
If you want you can launch it in a different environment, but the webpage will not give you useful informations.   

I used this container for a demonstration on how rancher works.

----------------------------------------------------------------

Now you can use this image also with *Kubernetes*, passing infos with environment variables:

```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: scale-tester
spec:
  replicas: 4
  selector:
    matchLabels:
      app: scale-tester
  template:
    metadata:
      labels:
        app: scale-tester
    spec:
      containers:
      - name: scale-tester
        image: leen15/rancher-scale-tester
        env:
        - name: K8S_NODE
          valueFrom:
            fieldRef:
              apiVersion: v1
              fieldPath: spec.nodeName
        - name: K8S_POD
          valueFrom:
            fieldRef:
              apiVersion: v1
              fieldPath: metadata.name
        - name: K8S_NAMESPACE
          valueFrom:
            fieldRef:
              apiVersion: v1
              fieldPath: metadata.namespace
        - name: K8S_IP
          valueFrom:
            fieldRef:
              apiVersion: v1
              fieldPath: status.podIP
  ```
