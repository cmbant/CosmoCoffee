#Makefile --- WMAP Likelihood code...
#
# CFITSIO is a library containing a collection of C and Fortran interfaces to read/write files
# using the FITS standard.  It can be downloaded from
# http://heasarc.gsfc.nasa.gov/docs/software/fitsio/fitsio.html
#
CFITSIO=/usr/local/lib
CFITSLIB=-lcfitsio

LAPACKDIR=/opt/intel/Compiler/curr/curr/mkl/lib/em64t
LAPACLLIB=-lmkl -lmkl_lapack -lmkl_core -lguide

#
#			Non-test object files.
#
WMAPLIB = libwmap7.a
OBJS = read_archive_map.o \
	read_fits.o \
	healpix_types.o \
	br_mod_dist.o \
	WMAP_7yr_options.o \
	WMAP_7yr_util.o \
	WMAP_7yr_gibbs.o \
	WMAP_7yr_tt_pixlike.o \
	WMAP_7yr_tt_beam_ptsrc_chisq.o \
	WMAP_7yr_teeebb_pixlike.o \
	WMAP_7yr_tetbeebbeb_pixlike.o \
	WMAP_7yr_likelihood.o
#
#			General Commands.
#
DIFF = diff -w
RM = rm -f

# See the CHANGES files for a description of these options
WMAPFLAGS  = -DOPTIMIZE
#WMAPFLAGS += -DUSE_LOWELL_TBEB    # turns on low-l maxlike TB/EB
#WMAPFLAGS += -DUSE_HIGHELL_TB     # turns on high-l master TB
#WMAPFLAGS += -DFASTERTT           # speed up matrix low-l TT
#WMAPFLAGS += -DTIMING             # print out timing stats for profiling

#
#			Compiler/linker configuration.  Several samples
#			are supplied.
#
## SGI IRIX/MIPSpro-- gets the LAPACK functions from the system SCSL library.
#F90    = f90
#FFLAGS = -O -64 $(WMAPFLAGS)
#INCS   = -I. -I$(CFITSIO)/include 
#LIBS   = -L. -L$(CFITSIO)/lib $(CFITSLIB) -lscs_mp

## SGI ProPack(Altix)/Intel -- gets the LAPACK functions from the system MKL.
#F90    = ifort
#FFLAGS = -O $(WMAPFLAGS)
#INCS   = -I. -I$(CFITSIO)/include
#LIBS   = -L. -L$(CFITSIO)/lib -L$(LAPACKDIR) $(LAPACLLIB) $(CFITSLIB) -lpthread

## CITA Sunnyvale
#F90     = ifort
#FFLAGS  = -O -xT -vec-report0 $(WMAPFLAGS)
#INCS    = -I. -I$(CFITSIO)/include
#LIBS    = -L. -L$(CFITSIO)/lib $(CFITSLIB) -L$(MCKENZIE_MKL_LIB_PATH) -lmkl_lapack -lmkl

# >>>>>> Note: the options below have not been tested recently. YMMV <<<<<<

## Linux desktop
#F90    = ifort
#FFLAGS = -O2 $(WMAPFLAGS) -u -g -O2 -CB -traceback -warn all -warn noerrors \
#-check all -check noarg_temp_created -fpe0 -zero -Vaxlib -fpp
#INCS   = -I. -I$(CFITSIO)/include
#LIBS   = -L. -L$(CFITSIO)/lib $(CFITSLIB) -L$(LAPACKDIR) $(LAPACLLIB)

## NAG
#F90	 = f95
#FFLAGS  = -g -O2 -kind=byte -colour $(WMAPFLAGS)
#INCS	 = -I. -I$(CFITSIO)/include -I<lapack path>/include
#LIBS	 = -L. -L$(CFITSIO)/lib -L$(LAPACKDIR) $(LAPACLLIB) $(CFITSLIB)

## MacOS X, G5 hardware
#F90 = <path to compiler>/xlf90 
#FFLAGS  = -qsuffix=f=f90:cpp=F90 -qstrict -qmaxmem=-1 \
#          -qarch=auto -qtune=auto -qunroll=auto -framework Accelerate -O2 \
#          $(WMAPFLAGS)
#INCS = -I. -I$(CFITSIO)/include
#LIBS = -L$(CFITSIO)/lib $(CFITSLIB) -lm -lSystemStubs

## MacOS X, G4 hardware
#F90 = <path to compiler>/xlf90 
#FFLAGS  = -qsuffix=f=f90:cpp=F90 -qstrict -qmaxmem=-1 \
#          -qarch=auto -qtune=auto -qunroll=auto -framework Accelerate -O2 \
#          $(WMAPFLAGS)
#INCS = -I. -I$(CFITSIO)/include
#LIBS = -L$(CFITSIO)/lib $(CFITSLIB)

F90=gfortran
#FFLAGS = -O2 -g $(WMAPFLAGS) 

## PGF90 -- Portland Group compiler.
#F90    = <path to compiler>/pgf90
#FFLAGS = -fast $(WMAPFLAGS)
#INCS   = <-DMPI if using mpi> -I<your mpi path>/include \
#         -I$(CFITSIO)/include
#LIBS   = -L. -L/usr/local/lib -l$(LLIB) \
#         -L<your cfitsio library path>/lib -L<your lapack/blas library path>/lib \
#         -L<other library path>/lib -llapack $(CFITSLIB) -lblas -l<other libraries, e.g. mpi>
#
#			Rules.
#
all: $(WMAPLIB) test

check: test
	./test

$(WMAPLIB): $(OBJS)
	ar r $@ $^

test: $(OBJS) test.o
	$(F90) $(FFLAGS) -o $@ test.o $(OBJS) $(LIBS)

%.o: %.f90
	$(F90) $(FFLAGS) $(INCS) -c -o $@ $<

%.o: %.F90
	$(F90) $(FFLAGS) $(INCS) -c -o $@ $<

clean:
	$(RM) *.o *.mod *.log *~ *.a test

distclean: clean
	$(RM) test

