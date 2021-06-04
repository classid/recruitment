FROM ghcr.io/digital-entropy/dokar-php/nginx:8.0

################################ Install Node & NPM
RUN apt-get update \
    && apt-get install -y --no-install-recommends gnupg gcc g++ make \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        curl \
        unzip \
        openssh-server \
        git \
    && curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt install nodejs -y \
    && node -v \
    && npm -v \
    && apt-get clean

CMD /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
