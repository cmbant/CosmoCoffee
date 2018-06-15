#
alias mal='make clean && make all'
alias mcl='make clean'

# configure env for prog..

source /local64/intel/Compiler/11.1/046/mkl/tools/environment/mklvarsem64t.sh

source /local64/intel/Compiler/11.1/046/bin/iccvars.sh ia64
source /local64/intel/Compiler/11.1/046/bin/ifortvars.sh ia64

#export LD_LIBRARY_PATH=/local64/intel/Compiler/11.1/046/mkl/lib/em64t:/usr/local/lib:$LD_LIBRARY_PATH

