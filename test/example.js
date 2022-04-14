await agent.goto('https://example.com/');
agent.output.myVar = myVar;
agent.output.title = (await agent.document.title);