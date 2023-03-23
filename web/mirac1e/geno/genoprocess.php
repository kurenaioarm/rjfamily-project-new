       // n: name, s: sex, m: mother, f: father, ux: wife, vir: husband, a: attributes/markers
      setupDiagram(myDiagram, [
        { key: 0, n: "daddy summer", s: "M", m: -10, f: -11, ux: 1 },
        { key: 1, n: "mommy summer", s: "F", m: -12, f: -13 },
        { key: 2, n: "summer sister", s: "F", m: 1, f: 0 },
        { key: 3, n: "summer(ME)", s: "M", m: 1, f: 0 , ux: 4 },
        { key: 4, n: "summer's wife", s: "F"},
        { key: 8, n: "summerJr.", s: "M", m: 4, f: 3},
        { key: -10, n: "Paternal Grandfather", s: "M", m: -33, f: -32, ux: -11, a: ["S"] },
        { key: -11, n: "Paternal Grandmother", s: "F", a: ["S"] },
      ],
        3 /* focus on this person */);
