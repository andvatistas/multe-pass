from subprocess import PIPE, Popen
# ,'resetpasses','resetstations','resetvehicles','stats'
for inp in ['healthcheck']:
    outputFile = inp
    f = open(outputFile)
    output = f.read()
    command = "python ../cli/se2160.py " + inp
    process = Popen(command, shell=True, stdout=PIPE, stderr=PIPE)
    producedOutput, err = process.communicate()

    if output == str(producedOutput.decode("utf-8")):
        print(f'+++ Testcase passed!')
    else:
        print(f'--- Testcase failed!')
        print(f'Expected Output:\n{output}')
        print(f'Produced Output:\n{producedOutput.decode("utf-8")}')
