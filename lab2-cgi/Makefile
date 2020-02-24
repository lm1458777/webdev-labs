TARGET = hello.cgi

TESTS = QueryParametersTests

CXX = clang++
CXXFLAGS = -std=c++17 -Wall -Wno-c++11-inline-namespace -Wno-c++11-extensions
CC = clang++

$(TARGET): hello.o QueryParameters.o

$(TESTS): QueryParameters.o QueryParametersTests.o

hello.o: QueryParameters.h
QueryParameters.o: QueryParameters.h

QueryParametersTests.o: QueryParameters.h
	$(CXX) $(CXXFLAGS) -c QueryParametersTests.cpp -I .

test: $(TESTS)
	./$(TESTS)

clean:
	rm -f $(TARGET) $(TESTS) *.o

install: $(TARGET)
	cp $(TARGET) ~/my-projects/WebDev/sites/cgi/