FROM python:3.8
RUN useradd --create-home --shell /bin/bash multe-pass
WORKDIR /home/multe-pass
COPY requirements.txt ./

RUN apt-get update && apt-get upgrade -y && apt-get autoremove && apt-get autoclean
RUN apt-get install -y \
	sudo \
    libffi-dev \
    libssl-dev \
    libfreetype6-dev \
    default-libmysqlclient-dev \
    zlib1g-dev \
    net-tools \
    vim \
    dos2unix \
    mariadb-server
RUN pip3 install --no-cache-dir -r requirements.txt
COPY . ./cli
COPY .bash_script.sh ./
COPY .bashrc ./
RUN dos2unix .bashrc
RUN dos2unix .bash_script.sh
USER multe-pass
CMD ["bash"]
