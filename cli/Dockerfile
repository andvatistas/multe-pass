FROM python:3.8-slim
RUN useradd --create-home --shell /bin/bash multe-pass
WORKDIR /home/multe-pass
COPY requirements.txt ./
RUN pip3 install --no-cache-dir -r requirements.txt
USER multe-pass
COPY . .
CMD ["bash"]
