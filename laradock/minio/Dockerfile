FROM minio/minio
ENV MINIO_ENDPOINT http://172.22.0.2:9000

ENTRYPOINT ["minio", "server", "/export"]
ENTRYPOINT ["/bin/bash", "-c", "docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' laravel-tech-storage-minio, $MINIO_ENDPOINT"]
